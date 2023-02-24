/**
 *  Title:          Main
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

//Imports
// import { PriorityQueue } from "./priorityQueue.js";
// var priorityQueue = new PriorityQueue();

import { A_Star } from "./a_star.js";
import { Map } from "./map.js";

export function search(nodes = [], connections = [], departure, destination) {
  //  Set Unset Locations
  if (nodes.length === 0 || connections.length === 0) {
    console.log("No Nodes/Connections Provided");
    return [];
  }

  //  connect nodes
  let map = Map(nodes, connections);

  // set unset locations
  if (typeof departure == "undefined" || typeof destination == "undefined") {
    console.log("No Departure/Destination Provided");
    return [];
    // departure = map[0];
    // destination = map[4];
  }

  var search = new A_Star(departure, destination);

  return search;
}
