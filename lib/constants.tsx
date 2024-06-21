import { AiFillTag } from "react-icons/ai";
import { BiSolidBarChartAlt2, BiSolidOffer } from "react-icons/bi";
import {
  BsFillPersonFill,
  BsBank2,
  BsImages,
  BsCartCheckFill,
  BsCoin,
} from "react-icons/bs";
import { LuCommand } from "react-icons/lu";
import { BsHouseDoor } from "react-icons/bs";
import { Shapes, Tag } from "lucide-react";

export const navLinks = [
  {
    url: "/",
    icon: <BsHouseDoor size={20} />,
    label: "Dashboard",
  },
  {
    url: "/commandes",
    icon: <LuCommand />,
    label: "Commandes",
  },
  {
    url: "/products",
    icon: <AiFillTag />,
    label: "Products",
    submenu: true,
    subMenuItems: [
      { title: "All", path: "/products" },
      { title: "New", path: "/products/new" },
    ],
  },
  {
    url: "/collections",
    icon: <Shapes />,
    label: "Collections",
  },
  {
    url: "/client",
    icon: <BsFillPersonFill />,
    label: "Client",
  },
  {
    url: "/contenu",
    icon: <BsImages />,
    label: "Contenu",
  },
  {
    url: "/finances",
    icon: <BsBank2 />,
    label: "Finances",
  },
  {
    url: "/analyses de données",
    icon: <BiSolidBarChartAlt2 />,
    label: "Analyses de données",
  },
  {
    url: "/marketing",
    icon: <BsCoin />,
    label: "Marketing",
  },
  {
    url: "/réductions",
    icon: <BiSolidOffer />,
    label: "Réductions",
  },
  {
    url: "/boutique en ligne",
    icon: <BsCartCheckFill />,
    label: "Boutique en ligne",
  },
];
