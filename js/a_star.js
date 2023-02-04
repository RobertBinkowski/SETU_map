/**
 *  Title:          A Star
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Node } from "./node.js";

let cols = 5;
let rows = 5;
let hight = 2;

let start; //starting grid point
let end; // ending grid point (goal)

let openSet = []; //array containing unevaluated grid points
let closedSet = []; //array containing completely evaluated grid points

let grid = new Array(cols);

function createMap(rows = 5, cols = 5) {
  let output = "";

  //Create 2D Array
  for (let i = 0; i < cols; i++) {
    grid[i] = new Array(rows);
    // Create a 3D Array
    // for (let ii = 0; ii < hight; ii++) {
    //   grid[i][ii] = new Array(hight);
    // }
  }

  //Populate Arrays
  for (let i = 0; i < cols; i++) {
    for (let j = 0; j < rows; j++) {
      grid[i][j] = new Node(i + j, i, j);
      output += "[" + j + "," + i + "]";
    }
    output += "\n";
  }

  //Update Neighbors
  for (let i = 0; i < cols; i++) {
    for (let j = 0; j < rows; j++) {
      grid[i][j].updateNeighbors(grid, rows, cols);
    }
  }
  start = grid[0][0];
  end = grid[cols - 1][rows - 1];

  openSet.push(start);

  return output;
}

console.log(createMap());
