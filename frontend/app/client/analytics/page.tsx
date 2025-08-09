"use client";
import { Line, LineChart, ResponsiveContainer, XAxis, YAxis, Tooltip } from "recharts";

const data = [
  { name: "Jan", orders: 30 },
  { name: "Feb", orders: 45 },
  { name: "Mar", orders: 28 }
];

export default function ClientAnalytics() {
  return (
    <div className="h-64">
      <ResponsiveContainer width="100%" height="100%">
        <LineChart data={data}>
          <XAxis dataKey="name" />
          <YAxis />
          <Tooltip />
          <Line type="monotone" dataKey="orders" stroke="#2563eb" />
        </LineChart>
      </ResponsiveContainer>
    </div>
  );
}
