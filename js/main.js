/**
 *  Title:          Main
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

//Imports
// import { PriorityQueue } from "./priorityQueue.js";
import { A_Star } from "./a_star.js";
import { Connection } from "./connection.js";
import { Map } from "./map.js";

// var priorityQueue = new PriorityQueue();

let map = Map();

let departure = map[0];
let destination = map[4];

console.log("Finished");
var search = new A_Star(departure, destination);

for (let i = 0; i < search.length; i++) {
  console.log(search[i].location);
}
