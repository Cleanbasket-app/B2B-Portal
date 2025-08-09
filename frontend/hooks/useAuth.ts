"use client";
import { useEffect, useState } from "react";

export type Role = "admin" | "client" | null;

export function useAuth() {
  const [role, setRole] = useState<Role>(null);

  useEffect(() => {
    const stored = window.localStorage.getItem("role") as Role;
    setRole(stored);
  }, []);

  const login = (r: Role) => {
    if (!r) return;
    window.localStorage.setItem("role", r);
    setRole(r);
  };

  const logout = () => {
    window.localStorage.removeItem("role");
    setRole(null);
  };

  return { role, login, logout };
}
