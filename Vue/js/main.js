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

export function search(
  locations = [],
  connections = [],
  departure = null,
  destination = null,
  disabled = false
) {
  //  Check if set
  if (locations.length === 0) {
    console.log("No locations");
    return [];
  }
  if (connections.length === 0) {
    console.log("No Connections");
    return [];
  }
  if (departure === null) {
    console.log("No Departure");
    return [];
  }
  if (destination === null) {
    console.log("No Destination");
    return [];
  }

  //  connect locations
  let map = Map(locations, connections);

  departure = map[departure.id];
  destination = map[destination.id];

  // set unset locations
  if (typeof departure == "undefined" || typeof destination == "undefined") {
    console.log("No Departure/Destination Provided");
    return [];
  }

  var search = new A_Star(departure, destination, disabled);

  return search;
}
