import { Map, prepareData } from "../map.js";
import { A_Star } from "../a_star.js";

const locations = [
  {
    id: 1,
    name: "A",
    geoLongitude: 1212,
    geoLatitude: 1221,
    mapLongitude: 250,
    mapLatitude: 200,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 2,
    name: "B",
    geoLongitude: 0,
    geoLatitude: 0,
    mapLongitude: 550,
    mapLatitude: 110,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 3,
    name: "C",
    geoLongitude: 1111,
    geoLatitude: 1,
    mapLongitude: 650,
    mapLatitude: 210,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 4,
    name: "D",
    geoLongitude: 1212,
    geoLatitude: 1221,
    mapLongitude: 250,
    mapLatitude: 200,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 5,
    name: "E",
    geoLongitude: 0,
    geoLatitude: 0,
    mapLongitude: 550,
    mapLatitude: 110,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 6,
    name: "F",
    geoLongitude: 1111,
    geoLatitude: 1,
    mapLongitude: 650,
    mapLatitude: 210,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 7,
    name: "A",
    geoLongitude: 1212,
    geoLatitude: 1221,
    mapLongitude: 250,
    mapLatitude: 200,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 8,
    name: "B",
    geoLongitude: 0,
    geoLatitude: 0,
    mapLongitude: 550,
    mapLatitude: 110,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 9,
    name: "C",
    geoLongitude: 1111,
    geoLatitude: 1,
    mapLongitude: 650,
    mapLatitude: 210,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
  {
    id: 10,
    name: "C",
    geoLongitude: 1111,
    geoLatitude: 1,
    mapLongitude: 650,
    mapLatitude: 210,
    mapAltitude: 0,
    type: "Location",
    enabled: true,
  },
];

const connections = [
  {
    id: 1,
    enabled: true,
    locationOne: locations[0],
    locationTwo: locations[3],
  },
  {
    id: 2,
    enabled: true,
    locationOne: locations[3],
    locationTwo: locations[1],
  },
  {
    id: 3,
    enabled: true,
    locationOne: locations[1],
    locationTwo: locations[5],
  },
  {
    id: 4,
    enabled: true,
    locationOne: locations[2],
    locationTwo: locations[4],
  },
  {
    id: 5,
    enabled: true,
    locationOne: locations[2],
    locationTwo: locations[5],
  },
  {
    id: 6,
    enabled: true,
    locationOne: locations[2],
    locationTwo: locations[5],
  },
  {
    id: 7,
    enabled: true,
    locationOne: locations[5],
    locationTwo: locations[4],
  },
  {
    id: 8,
    enabled: true,
    locationOne: locations[6],
    locationTwo: locations[1],
  },
  {
    id: 9,
    enabled: true,
    locationOne: locations[6],
    locationTwo: locations[1],
  },
  {
    id: 10,
    enabled: true,
    locationOne: locations[5],
    locationTwo: locations[7],
  },
  {
    id: 11,
    enabled: true,
    locationOne: locations[5],
    locationTwo: locations[8],
  },
  {
    id: 12,
    enabled: true,
    locationOne: locations[7],
    locationTwo: locations[9],
  },
  {
    id: 13,
    enabled: true,
    locationOne: locations[8],
    locationTwo: locations[9],
  },
  {
    id: 14,
    enabled: true,
    locationOne: locations[1],
    locationTwo: locations[4],
  },
];

// const [nodes, conn] = prepareData(locations, connections);
const map = Map(locations, connections);
const departure = map[0]; // Node A
const destination = map[2]; // Node C

const [distance, nodeIds, path] = A_Star(departure, destination);

console.log("Distance:", distance);
console.log("Path:", path.map((node) => node.name).join(" <- "));
