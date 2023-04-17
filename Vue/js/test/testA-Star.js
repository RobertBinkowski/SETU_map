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
];

const connections = [
  {
    id: 1,
    enabled: true,
    locationOne: locations[0],
    locationTwo: locations[1],
  },
  {
    id: 2,
    enabled: true,
    locationOne: locations[1],
    locationTwo: locations[2],
  },
  {
    id: 3,
    enabled: true,
    locationOne: locations[0],
    locationTwo: locations[2],
  },
];

// const [nodes, conn] = prepareData(locations, connections);
const map = Map(locations, connections);
const departure = map[0]; // Node A
const destination = map[2]; // Node C

const [distance, path] = A_Star(departure, destination);

console.log("Distance:", distance);
console.log("Path:", path.map((node) => node.name).join(" -> "));
