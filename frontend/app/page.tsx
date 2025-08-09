"use client";
import { Button } from "@/components/ui/button";
import { useAuth } from "@/hooks/useAuth";
import { useRouter } from "next/navigation";

export default function Home() {
  const { login } = useAuth();
  const router = useRouter();

  const handle = (role: "client" | "admin") => {
    login(role);
    router.push("/" + role);
  };

  return (
    <main className="flex h-screen items-center justify-center space-x-4">
      <Button onClick={() => handle("client")}>Client Login</Button>
      <Button onClick={() => handle("admin")}>Admin Login</Button>
    </main>
  );
}
