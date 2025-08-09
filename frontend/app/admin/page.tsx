import { OrderCard } from "@/components/OrderCard";

export default function AdminDashboard() {
  return (
    <div className="grid gap-4 md:grid-cols-3">
      <OrderCard title="Orders in Progress" value="8" />
      <OrderCard title="Revenue" value="$24k" />
      <OrderCard title="Clients" value="12" />
    </div>
  );
}
