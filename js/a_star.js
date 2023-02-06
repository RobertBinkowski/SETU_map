/**
 *  Title:          A Star
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Map } from "./map.js";

//Size of the Map
let rows = 5;
let cols = 5;
let height = 1;

// Create a map array
let map = Map(rows, cols, height);

//Search Locations
let departure = map[0][0][1]; // Initial Departure
let location = map[0][1][1]; // Current Location
let destination = map[0][cols - 1][rows - 1]; // Destination of the trip

console.log(destination.location);

console.log(departure.location);
console.log(location.location);
console.log(destination.neighbors);
