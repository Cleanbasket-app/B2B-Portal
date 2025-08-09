"use client";
import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Dialog, DialogContent, DialogHeader, DialogTrigger } from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Badge } from "@/components/ui/badge";

export default function AdminOrders() {
  const [open, setOpen] = useState(false);
  return (
    <div className="space-y-4">
      <Dialog open={open} onOpenChange={setOpen}>
        <DialogTrigger asChild>
          <Button>New Order</Button>
        </DialogTrigger>
        <DialogContent>
          <DialogHeader>New Order</DialogHeader>
          <Input placeholder="Order name" className="mb-2" />
          <Button onClick={() => setOpen(false)}>Save</Button>
        </DialogContent>
      </Dialog>

      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>ID</TableHead>
            <TableHead>Client</TableHead>
            <TableHead>Status</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow>
            <TableCell>1</TableCell>
            <TableCell>ACME</TableCell>
            <TableCell><Badge>Processing</Badge></TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  );
}
