import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";
import { CircleDollarSign, ShoppingBag, UserRound } from "lucide-react";

export default function Home() {
  return (
   
    <div className="px-8 py-10">
      <p className="text=heading2-bold">Dashboard</p>
      <Separator className="bg-grey-1 my-5" />
      <div className="grid grid-cols-2 md:grid-cols-3 gap-10">
        <Card>
          <CardHeader className="flex justify-between items-center">
            <CardTitle>Ventes Total</CardTitle>
            <CircleDollarSign className="max-sm:hidden"/>
          </CardHeader>
          <CardContent>
            <p className="text-body-bold">$ 4500</p>
          </CardContent>
        </Card>
         <Card>
          <CardHeader className="flex justify-between items-center">
            <CardTitle>Total Des Commandes</CardTitle>
            <ShoppingBag className="max-sm:hidden"/>
          </CardHeader>
          <CardContent>
            <p className="text-body-bold">1236</p>
          </CardContent>
        </Card>

         <Card>
          <CardHeader className="flex justify-between items-center">
            <CardTitle>Visites Boutiques</CardTitle>
            <UserRound className="max-sm:hidden"/>
          </CardHeader>
          <CardContent>
            <p className="text-body-bold">152</p>
          </CardContent>
        </Card>

      </div>
    </div>
 
  );
}

