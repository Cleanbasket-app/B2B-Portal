#!/usr/bin/env bash
set -euo pipefail

DRY_RUN=false
ASSUME_YES=false
VERBOSE=false

log() {
  echo "[INFO] $*"
}
warn() {
  echo "[WARN] $*" >&2
}
err() {
  echo "[ERROR] $*" >&2
}

run() {
  if $VERBOSE; then set -x; fi
  if $DRY_RUN; then
    echo "[DRY-RUN] $*"
  else
    eval "$@"
  fi
  if $VERBOSE; then set +x; fi
}

confirm() {
  local prompt="$1"
  if $ASSUME_YES; then
    return 0
  fi
  read -r -p "$prompt [y/N]: " response
  case "${response}" in
    [yY][eE][sS]|[yY])
      return 0
      ;;
    *)
      return 1
      ;;
  esac
}

show_usage() {
  cat <<USAGE
Usage: $0 [--dry-run] [--yes] [--verbose]
Safely uninstall PHP from the system.
USAGE
}

while [[ $# -gt 0 ]]; do
  case "$1" in
    --dry-run)
      DRY_RUN=true
      shift
      ;;
    --yes)
      ASSUME_YES=true
      shift
      ;;
    --verbose)
      VERBOSE=true
      shift
      ;;
    -h|--help)
      show_usage
      exit 0
      ;;
    *)
      err "Unknown argument: $1"
      show_usage
      exit 1
      ;;
  esac
done

log "Checking current PHP installation"
if command -v php >/dev/null 2>&1; then
  PHP_BIN=$(command -v php)
  log "php found at $PHP_BIN"
  if ! php -v >/dev/null 2>&1; then
    warn "php -v failed"
  else
    php -v || true
  fi
else
  warn "PHP not found in PATH"
  PHP_BIN=""
fi

OS="unknown"
PKG_MANAGER=""
if [[ "$OSTYPE" == linux* ]]; then
  if command -v apt >/dev/null 2>&1; then
    OS="debian"
    PKG_MANAGER="apt"
  elif command -v dnf >/dev/null 2>&1; then
    OS="rhel"
    PKG_MANAGER="dnf"
  elif command -v yum >/dev/null 2>&1; then
    OS="rhel"
    PKG_MANAGER="yum"
  fi
elif [[ "$OSTYPE" == darwin* ]]; then
  OS="mac"
  if command -v brew >/dev/null 2>&1; then
    PKG_MANAGER="brew"
  fi
fi

PREFIX=""
SRC_DIR=""

if [[ -z "$PKG_MANAGER" ]]; then
  log "Attempting to detect source-compiled PHP"
  if [[ -n "$PHP_BIN" ]]; then
    PHP_REAL=$(readlink -f "$PHP_BIN" || echo "$PHP_BIN")
    log "PHP binary resolved to $PHP_REAL"
    if php -i >/tmp/phpinfo.$$ 2>/dev/null; then
      CONFIGURE=$(grep -i 'Configure Command' /tmp/phpinfo.$$ | sed 's/.*=> //')
      PREFIX=$(echo "$CONFIGURE" | sed -n "s/.*--prefix=\([^ ]*\).*/\1/p")
      rm -f /tmp/phpinfo.$$ || true
    fi
  fi
  if [[ -z "$PREFIX" ]]; then
    if $ASSUME_YES; then
      PREFIX="/usr/local"
    else
      read -r -p "Enter PHP installation prefix [/usr/local]: " PREFIX
      PREFIX=${PREFIX:-/usr/local}
    fi
  fi
fi

plan_removal() {
  case "$PKG_MANAGER" in
    apt)
      echo "sudo apt remove -y 'php*'"
      echo "sudo apt purge -y 'php*'"
      echo "sudo apt autoremove -y"
      ;;
    dnf|yum)
      echo "sudo $PKG_MANAGER remove -y 'php*'"
      ;;
    brew)
      echo "brew list --formula | grep -E '^php(@|$)' | xargs -r brew uninstall --force"
      ;;
    *)
      if [[ -n "$SRC_DIR" ]]; then
        echo "sudo make uninstall -C '$SRC_DIR'"
      fi
      for path in "$PREFIX/bin" "$PREFIX/sbin" "$PREFIX/include" "$PREFIX/lib" "$PREFIX/lib64" "$PREFIX/etc" \
                  /usr/local/bin /usr/local; do
        echo "rm -fv \"$path/php*\""
      done
      ;;
  esac
}

log "Planned actions:"
plan_removal

if ! confirm "Proceed with uninstall?"; then
  log "Aborted"
  exit 0
fi

case "$PKG_MANAGER" in
  apt)
    run "sudo apt remove -y 'php*'"
    run "sudo apt purge -y 'php*'"
    run "sudo apt autoremove -y"
    ;;
  dnf|yum)
    run "sudo $PKG_MANAGER remove -y 'php*'"
    ;;
  brew)
    if command -v brew >/dev/null 2>&1; then
      FORMULAE=$(brew list --formula | grep -E '^php(@|$)' || true)
      if [[ -n "$FORMULAE" ]]; then
        for f in $FORMULAE; do
          run "brew uninstall --force $f"
        done
      else
        warn "No PHP formulae found via brew"
      fi
    fi
    ;;
  *)
    if [[ -n "$SRC_DIR" ]]; then
      if [[ -f "$SRC_DIR/Makefile" ]] && grep -q '^uninstall:' "$SRC_DIR/Makefile"; then
        run "sudo make uninstall -C '$SRC_DIR'"
      fi
    fi
    for path in "$PREFIX/bin" "$PREFIX/sbin" "$PREFIX/include" "$PREFIX/lib" "$PREFIX/lib64" "$PREFIX/etc"; do
      run "sudo rm -rf \"$path/php*\""
    done
    for path in /usr/local/bin/php /usr/local/php*; do
      run "sudo rm -rf \"$path\""
    done
    ;;
  esac

log "Verification after removal"
if command -v php >/dev/null 2>&1; then
  warn "PHP still present: $(command -v php)"
  log "Additional locations:"
  type -a php || true
  find /usr /usr/local /opt/homebrew -maxdepth 4 -type f -name 'php' 2>/dev/null | head -n 50 || true
else
  log "PHP successfully removed"
fi

log "Next steps: install PHP via your preferred method if needed"
