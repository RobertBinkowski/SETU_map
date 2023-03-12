/**
 *  Title:          A Star
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { geoDistance } from "./functions.js";

/**
 *
 * A* Implementation
 *
 * @param {Node} departure - Departure Node
 * @param {Node} destination - Destination Node
 * @returns Array of nodes to the destination
 */
export function A_Star(departure, destination) {
  //  Check if undefined
  if (typeof departure == "undefined" || typeof destination == "undefined") {
    console.log("Error: Values Were Undefined");
    return output;
  }

  // Set Variables
  var output = []; // Output of the application
  let unchecked = []; //  Unchecked Nodes
  let checked = []; //  Checked Nodes
  let path = []; // Path to the destination
  var distance = 0; // Total Geo Distance to the location

  unchecked.push(departure);

  while (unchecked.length > 0) {
    let lowestIndex = 0;

    for (let i = 0; i < unchecked.length; i++) {
      if (unchecked[i].f < unchecked[lowestIndex].f) {
        lowestIndex = i;
      }
    }

    let current = unchecked[lowestIndex];

    //If found solution
    if (current === destination) {
      let temp = current;
      path.push(temp);
      while (temp.parent) {
        path.push(temp.parent);
        distance = geoDistance(temp, temp.parent, true);
        temp = temp.parent;
      }

      // return path data
      output["distance"] = distance | 0; // Make A whole number
      output["path"] = path.reverse();

      return output;
    }

    //remove current from unchecked
    unchecked.splice(lowestIndex, 1);
    //add current to checked
    checked.push(current);

    let connections = current.connections;

    for (let i = 0; i < connections.length; i++) {
      let neighbor = connections[i];

      if (!checked.includes(neighbor)) {
        let possibleG = current.g + 1;

        if (!unchecked.includes(neighbor)) {
          unchecked.push(neighbor);
        } else if (possibleG >= neighbor.g) {
          continue;
        }

        neighbor.g = possibleG;
        neighbor.h = geoDistance(neighbor, destination); // Heuristic
        neighbor.f = neighbor.g + neighbor.h;
        neighbor.parent = current;
      }
    }
  }

  //no path found
  console.log("No Solution Found");
  return output;
}
