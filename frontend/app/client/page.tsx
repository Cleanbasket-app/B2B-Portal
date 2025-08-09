import { OrderCard } from "@/components/OrderCard";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";

export default function ClientDashboard() {
  return (
    <Tabs defaultValue="overview" className="space-y-4">
      <TabsList>
        <TabsTrigger value="overview">Overview</TabsTrigger>
        <TabsTrigger value="details">Details</TabsTrigger>
      </TabsList>
      <TabsContent value="overview" className="grid gap-4 md:grid-cols-3">
        <OrderCard title="Active Orders" value="5" />
        <OrderCard title="Next Pickup" value="Tomorrow" />
        <OrderCard title="Monthly Spend" value="$1200" />
      </TabsContent>
      <TabsContent value="details">
        <p className="text-sm text-gray-500">More details coming soon.</p>
      </TabsContent>
    </Tabs>
  );
}
