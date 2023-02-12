/**
 *  Title:          A Star
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { calculateDistance } from "./functions.js";

/**
 *
 * A* Implementation
 *
 * @param {Node} departure - Departure Node
 * @param {Node} destination - Destination Node
 * @returns Array of nodes to the destination
 */
export function A_Star(departure, destination) {
  let unchecked = []; // unchecked Nodes
  let checked = []; // checked Nodes

  let path = []; // complete path to the destination

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
        temp = temp.parent;
      }
      // return the traced path
      return path.reverse();
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
        neighbor.h = calculateDistance(neighbor, destination); // Heuristic
        neighbor.f = neighbor.g + neighbor.h;
        neighbor.parent = current;
      }
    }
  }

  //no path found
  return [];
}
