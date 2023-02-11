/**
 *  Title:          Main
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

//Imports
// import { PriorityQueue } from "./priorityQueue.js";
import { A_Star } from "./a_star.js";
import { Map } from "./map.js";

// import { Node } from "./node.js";
// var priorityQueue = new PriorityQueue();

//Size of the Map
let rows = 50;
let cols = 50;
let height = 1;

// Create a map array
let map = Map(rows, cols, height);

//Search Locations
let departure = map[0][0][0]; // Initial Departure
let location = map[0][1][2]; // Current Location
let destination = map[0][cols - 1][rows - 1]; // Destination of the trip

var search = new A_Star(departure, destination);

for (let i = 0; i < search.length; i++) {
  console.log(search[i].location);
}

// const node = new Node("Hello Here", 1, 2, 3);

// console.log(node.x);

console.log(search[10].x);
