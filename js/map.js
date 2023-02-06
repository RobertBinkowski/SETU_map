import { Node } from "./node.js";

export function Map(rows = 5, cols = 5, height = 1) {
  //Create a Grid of layers
  let grid = new Array(height);

  let x = 0;
  let y = 0;
  let z = 0;

  //Create a grid of columns and rows
  for (y = 0; y < height; y++) {
    grid[y] = new Array(cols);
    for (x = 0; x < cols; x++) {
      grid[y][x] = new Array(rows);
    }
  }

  //Populate Arrays - Nodes
  for (z = 0; z < height; z++) {
    for (y = 0; y < cols; y++) {
      for (x = 0; x < rows; x++) {
        grid[z][y][x] = new Node(null, x, y, z);
      }
    }
  }

  //Update Nodes Neighbors
  for (z = 0; z < height; z++) {
    for (y = 0; y < cols; y++) {
      for (x = 0; x < rows; x++) {
        grid[z][y][x].updateNeighbors(grid, rows, cols, height);
      }
    }
  }

  return grid;
}
