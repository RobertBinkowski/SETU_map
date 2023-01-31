/**
 *  Title:          Main
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */
import { PriorityQueue } from "./priorityQueue.js";
// import "./a_star.js";

//Size of the Grid
let cols = 5;
let rows = 5;
let height = 0;

//Width size of the map
let grid = new Array(cols);

let openSet = []; //array containing unevaluated grid points
let closedSet = []; //array containing completely evaluated grid points

let start;
let end;

let path = [];

var priorityQueue = new PriorityQueue();
priorityQueue.enqueue("Hello", cols, 12, 1, 0);
priorityQueue.enqueue("Man", 2, 12, 1, 0);
priorityQueue.enqueue("How", 3, 12, 1, 0);
priorityQueue.enqueue("U?", 4, 12, 1, 0);

console.log(priorityQueue.printQueue());
