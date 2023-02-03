/**
 *  Title:          A Star
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */
// import { Node } from "./oldNode";
/**
 *
 * Heuristic function to calculate the heuristic value between 2 points
 *
 * @param {Node} start - start Node
 * @param {Node} end - end Node
 * @returns combined difference between 2 points
 */
function calculateHeuristic(start, end) {
  //Calculate the distance between 2 nodes
  let d1 = Math.abs(start.x - end.x);
  let d2 = Math.abs(start.y - end.y);
  let d3 = Math.abs(start.z - end.z);

  //Return the outcome which is a heuristic value
  return Math.abs(d1 + d2 + d3);
}

/**
 *
 * @param {Node} cameFrom - Previous Node/s
 * @param {Node} current - Current Node
 */
function reconstructPath(previous, current) {
  const path = { current };
  while (current !== previous.key) {
    current = previous[current];
    path.prepend(current);
  }
  return path;
}

let cols = 5;
let rows = 5;
let grid = new Array(cols);

function Node(x, y) {
  this.x = x;
  this.y = y;
  this.f = 0;
  this.g = 0;
  this.h = 0;
  this.neighbors = [];
  this.parent = undefined;

  // update neighbors array for a given grid point
  this.updateNeighbors = function (grid) {
    let i = this.x;
    let j = this.y;
    if (i < cols - 1) {
      this.neighbors.push(grid[i + 1][j]);
    }
    if (i > 0) {
      this.neighbors.push(grid[i - 1][j]);
    }
    if (j < rows - 1) {
      this.neighbors.push(grid[i][j + 1]);
    }
    if (j > 0) {
      this.neighbors.push(grid[i][j - 1]);
    }
  };
}

function createMap(rows = 5, cols = 5) {
  for (let i = 0; i < cols; i++) {
    grid[i] = new Array(rows);
  }

  for (let i = 0; i < cols; i++) {
    for (let j = 0; j < rows; j++) {
      grid[i][j] = new Node(i, j);
    }
  }

  for (let i = 0; i < cols; i++) {
    for (let j = 0; j < rows; j++) {
      grid[i][j].updateNeighbors(grid);
    }
  }
  start = grid[0][0];
  end = grid[cols - 1][rows - 1];

  openSet.push(start);

  console.log(grid);
}

console.log(createMap());

// // A* finds a path from start to goal.
// // h is the heuristic function. h(n) estimates the cost to reach goal from node n.
// export function A_Star(start, goal, h){
//     // The set of discovered nodes that may need to be (re-)expanded.
//     // Initially, only the start node is known.
//     // This is usually implemented as a min-heap or priority queue rather than a hash-set.
//     openSet := {start}

//     // For node n, cameFrom[n] is the node immediately preceding it on the cheapest path from start
//     // to n currently known.
//     cameFrom := an empty map

//     // For node n, gScore[n] is the cost of the cheapest path from start to n currently known.
//     gScore := map with default value of Infinity
//     gScore[start] := 0

//     // For node n, fScore[n] := gScore[n] + h(n). fScore[n] represents our current best guess as to
//     // how cheap a path could be from start to finish if it goes through n.
//     fScore := map with default value of Infinity
//     fScore[start] := h(start)

//     while (openSet > 0){
//         // This operation can occur in O(Log(N)) time if openSet is a min-heap or a priority queue
//         current := the node in openSet having the lowest fScore[] value
//         if (current == goal){
//             return reconstructPath(cameFrom, current);
//         }
//         openSet.Remove(current)
//         foreach ( neighbor as current){
//             // d(current,neighbor) is the weight of the edge from current to neighbor
//             // tentative_gScore is the distance from start to the neighbor through current
//             tentative_gScore := gScore[current] + d(current, neighbor)
//             if tentative_gScore < gScore[neighbor]
//                 // This path to neighbor is better than any previous one. Record it!
//                 cameFrom[neighbor] := current
//                 gScore[neighbor] := tentative_gScore
//                 fScore[neighbor] := tentative_gScore + h(neighbor)
//                 if neighbor not in openSet
//                     openSet.add(neighbor)
//         }
//     }
//     // Open set is empty but goal was never reached
//     return failure
// }
