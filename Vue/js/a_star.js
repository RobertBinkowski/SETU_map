import { Node } from "./node.js"; // Make sure to import updated classes
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
  const pathIds = []; // PathIds to the destination
  const path = []; // PathIds to the destination
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
      pathIds.push(temp.id);
      path.push(temp);

      // Backtrack from the destination to the departure to get the pathIds
      while (temp.parent) {
        pathIds.push(temp.parent.id);
        path.push(temp.parent);
        distance += geoDistance(temp, temp.parent, true);
        temp = temp.parent;
      }

      // Prepare the distance
      distance = { distance: distance | 0, metric: "m" };

      // Return the pathIds and distance in an array
      return [distance, pathIds.reverse(), path]; // Make distance a whole number
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
        if (checked.has(neighbor) || neighbor === undefined) {
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
