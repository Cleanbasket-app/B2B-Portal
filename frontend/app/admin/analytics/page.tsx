"use client";
import { Bar, BarChart, ResponsiveContainer, XAxis, YAxis, Tooltip } from "recharts";

const data = [
  { name: "Jan", revenue: 2000 },
  { name: "Feb", revenue: 2400 },
  { name: "Mar", revenue: 1800 }
];

export default function AdminAnalytics() {
  return (
    <div className="h-64">
      <ResponsiveContainer width="100%" height="100%">
        <BarChart data={data}>
          <XAxis dataKey="name" />
          <YAxis />
          <Tooltip />
          <Bar dataKey="revenue" fill="#16a34a" />
        </BarChart>
      </ResponsiveContainer>
    </div>
  );
}
