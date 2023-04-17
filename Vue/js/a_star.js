import { Node } from "./node.js"; // Make sure to import updated classes
import { Connection } from "./connection.js";
import { geoDistance } from "./functions.js";

/**
 * A* Implementation
 *
 * @param {Node} departure - Departure Node
 * @param {Node} destination - Destination Node
 * @param {boolean} disabled - Whether or not disabled access is allowed
 * @returns Array of nodes to the destination and distance in meters
 */
export function A_Star(departure, destination, disabled = false) {
  // Check if nodes are undefined
  if (!departure || !destination) {
    console.log("Error: Values Were Undefined");
    return [];
  }

  // Initialize variables
  const unchecked = new Map(); // Nodes to be checked
  const checked = new Set(); // Nodes that have been checked
  const path = []; // Path to the destination
  let distance = 0; // Total distance to the destination

  // Add the departure node to the unchecked list
  unchecked.set(departure, departure.f);

  // While there are still nodes to check
  while (unchecked.size > 0) {
    // Get the node with the lowest f-score from the unchecked list
    const current = Array.from(unchecked.keys()).reduce((a, b) =>
      a.f < b.f ? a : b
    );

    // If the current node is the destination, we're done
    if (current.id === destination.id) {
      let temp = current;
      path.push(temp);
      // Backtrack from the destination to the departure to get the path
      while (temp.parent) {
        path.push(temp.parent);
        distance += geoDistance(temp, temp.parent, true);
        temp = temp.parent;
      }

      distance = { distance: distance | 0, metric: "km" };

      // Return the path and distance in an array
      return [distance, path.reverse()]; // Make distance a whole number
    }

    // Remove the current node from the unchecked list and add it to the checked list
    unchecked.delete(current);
    checked.add(current);

    // If the current node is a staircase and disabled access is allowed, skip it
    if (current.type == "Stairs" && disabled) {
      continue;
    } else {
      // Loop through the current node's connections
      const connections = current.connections;

      for (let i = 0; i < connections.length; i++) {
        const neighbor = connections[i];

        // If the neighbor has already been checked, skip it
        if (checked.has(neighbor)) {
          continue;
        }

        // Calculate the possible g-score for the neighbor node
        const possibleG = current.g + 1;

        // If the neighbor hasn't been added to the unchecked list yet, add it
        if (!unchecked.has(neighbor) || possibleG < neighbor.g) {
          neighbor.g = possibleG;
          neighbor.h = geoDistance(neighbor, destination); // Calculate the heuristic (h-score)
          neighbor.f = neighbor.g + neighbor.h; // Calculate the f-score
          neighbor.parent = current; // Set the parent node
          unchecked.set(neighbor, neighbor.f); // Add the neighbor to the unchecked list
        }
      }
    }
  }

  // If no path was found, return an empty array
  console.log("No Solution Found");
  return [];
}
