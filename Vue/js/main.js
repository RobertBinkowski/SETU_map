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
  }
  if (destination === null) {
    console.log("No Destination");
    return [];
  }

  //  connect locations
  let map = Map(locations, connections);
  // Set Departure and Destination
  departure = map.find((dep) => dep.id === departure.id);
  destination = map.find((dep) => dep.id === destination.id);

  // Check if departure and destination are set
  if (typeof departure == "undefined" || typeof destination == "undefined") {
    console.log("No Departure/Destination Provided");
    return [];
  }

  // Find the closest node to the departure and destination
  var search = new A_Star(departure, destination, disabled);

  // Return the path
  return search;
}
