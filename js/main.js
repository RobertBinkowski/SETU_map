/**
 *  Title:          Main
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

//Imports
import { PriorityQueue } from "./priorityQueue.js";
import { A_Star } from "./a_star.js";

var priorityQueue = new PriorityQueue();

var search = new A_Star();

let openSet = []; //array containing unevaluated grid points
let closedSet = []; //array containing completely evaluated grid points

let start;
let end;

let path = [];
