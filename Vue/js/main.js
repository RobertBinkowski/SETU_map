/**
 *  Title:          Main
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

//Imports
// import { PriorityQueue } from "./priorityQueue.js";
import { A_Star } from "./a_star.js";
import { Connection } from "./connection.js";
import { Map } from "./map.js";
import { Node } from "./node.js";
// var priorityQueue = new PriorityQueue();

//  Arrays
let nodes = [];
let connections = [];

//  Hard Coded
let node1 = new Node("One", 0, 0);
let node2 = new Node("Two", 1, 2);
let node3 = new Node("Three", 2, 4);
let node4 = new Node("Four", 1, 5);
let node5 = new Node("Five", 12, 22);
let connection1 = new Connection(1, 2);
let connection2 = new Connection(2, 3);
let connection3 = new Connection(3, 4);
let connection4 = new Connection(4, 5);
let connection5 = new Connection(1, 5);
nodes.push(node1);
nodes.push(node2);
nodes.push(node3);
nodes.push(node4);
nodes.push(node5);
connections.push(connection1);
connections.push(connection2);
connections.push(connection3);
connections.push(connection4);
connections.push(connection5);
//  End of Hardcode

let map = Map(nodes, connections);

let departure = map[0];
let destination = map[4];

console.log("Finished");
var search = new A_Star(departure, destination);

for (let i = 0; i < search.length; i++) {
  console.log(search[i].location);
}
