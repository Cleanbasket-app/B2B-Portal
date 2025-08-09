"use client";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { Home, BarChart2, ShoppingCart, Settings, Users, Calendar, MapPin, CreditCard } from "lucide-react";
import { cn } from "@/lib/utils";

interface Item {
  href: string;
  label: string;
  icon: React.ComponentType<{ className?: string }>;
}

export function Sidebar({ items }: { items: Item[] }) {
  const pathname = usePathname();
  return (
    <aside className="w-60 bg-gray-100 dark:bg-gray-900 h-screen p-4 space-y-2">
      {items.map((item) => (
        <Link
          key={item.href}
          href={item.href}
          className={cn(
            "flex items-center space-x-2 rounded-md p-2 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-800",
            pathname === item.href && "bg-gray-200 dark:bg-gray-800"
          )}
        >
          <item.icon className="w-4 h-4" />
          <span>{item.label}</span>
        </Link>
      ))}
    </aside>
  );
}

export const clientNav: Item[] = [
  { href: "/client", label: "Dashboard", icon: Home },
  { href: "/client/orders", label: "Orders", icon: ShoppingCart },
  { href: "/client/analytics", label: "Analytics", icon: BarChart2 },
  { href: "/client/schedule", label: "Schedule", icon: Calendar },
  { href: "/client/locations", label: "Locations", icon: MapPin },
  { href: "/client/team", label: "Team", icon: Users },
  { href: "/client/settings", label: "Settings", icon: Settings }
];

export const adminNav: Item[] = [
  { href: "/admin", label: "Dashboard", icon: Home },
  { href: "/admin/clients", label: "Clients", icon: Users },
  { href: "/admin/services", label: "Services", icon: ShoppingCart },
  { href: "/admin/orders", label: "Orders", icon: ShoppingCart },
  { href: "/admin/staff", label: "Staff", icon: Users },
  { href: "/admin/schedule", label: "Schedule", icon: Calendar },
  { href: "/admin/analytics", label: "Analytics", icon: BarChart2 },
  { href: "/admin/billing", label: "Billing", icon: CreditCard },
  { href: "/admin/erp", label: "ERP", icon: Settings },
  { href: "/admin/settings", label: "Settings", icon: Settings }
];
