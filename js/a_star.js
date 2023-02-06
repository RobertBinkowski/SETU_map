/**
 *  Title:          A Star
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { calculateHeuristic } from "./functions.js";

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

    let neighbors = current.neighbors;

    for (let i = 0; i < neighbors.length; i++) {
      let neighbor = neighbors[i];

      if (!checked.includes(neighbor)) {
        let possibleG = current.g + 1;

        if (!unchecked.includes(neighbor)) {
          unchecked.push(neighbor);
        } else if (possibleG >= neighbor.g) {
          continue;
        }

        neighbor.g = possibleG;
        neighbor.h = calculateHeuristic(neighbor, destination);
        neighbor.f = neighbor.g + neighbor.h;
        neighbor.parent = current;
      }
    }
  }

  //no path found
  return [];
}

function printMap(map) {
  let output = "\n\n\n";
  for (let z = 0; z < map.length; z++) {
    for (let y = 0; y < map[z].length; y++) {
      for (let x = 0; x < map[z][y].length; x++) {
        output += map[z][y][x].f;
      }
      output += "\n";
    }
    output += "\n";
  }
  console.log(output);
}
