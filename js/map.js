import { getSystemErrorMap } from "util";
import { Node } from "./node.js";

export function Map(rows = 5, cols = 5, height = 1) {
  let grid = new Array(cols);

  //Create 2D Array - Create a map
  for (let i = 0; i < cols; i++) {
    grid[i] = new Array(rows);
    // Create a 3D Array if height is greater than 1 layer
    if (height > 1) {
      for (let ii = 0; ii < height; ii++) {
        grid[i][ii] = new Array(height);
      }
    }
  }

  //Populate Arrays - Nodes
  for (let i = 0; i < cols; i++) {
    for (let j = 0; j < rows; j++) {
      grid[i][j] = new Node("None", i, j);
    }
  }

  //Update Nodes Neighbors
  for (let i = 0; i < cols; i++) {
    for (let j = 0; j < rows; j++) {
      grid[i][j].updateNeighbors(grid, rows, cols);
    }
  }
  return grid;
}
