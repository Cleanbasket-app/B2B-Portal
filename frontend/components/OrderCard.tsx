import { Card, CardContent, CardHeader } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";

interface OrderCardProps {
  title: string;
  value: string;
  status?: string;
}

export function OrderCard({ title, value, status }: OrderCardProps) {
  return (
    <Card>
      <CardHeader className="flex justify-between">
        <span>{title}</span>
        {status && <Badge>{status}</Badge>}
      </CardHeader>
      <CardContent>
        <p className="text-2xl font-bold">{value}</p>
      </CardContent>
    </Card>
  );
}
