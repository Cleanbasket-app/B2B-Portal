"use client";
import { useEffect } from "react";
import { useRouter } from "next/navigation";
import { Role, useAuth } from "@/hooks/useAuth";
import { LoadingSpinner } from "@/components/LoadingSpinner";

export function AuthGate({ children, allow }: { children: React.ReactNode; allow: Role[] }) {
  const { role } = useAuth();
  const router = useRouter();

  useEffect(() => {
    if (role && !allow.includes(role)) {
      router.replace("/" + role);
    }
  }, [role, allow, router]);

  if (!role) {
    return <LoadingSpinner />;
  }

  if (!allow.includes(role)) {
    return <div className="p-4">Unauthorized</div>;
  }

  return <>{children}</>;
}
