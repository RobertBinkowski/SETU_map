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

export function search(nodes = [], connections = [], departure, destination) {
  //  Set Unset Locations
  if (nodes.length === 0) {
    let node1 = new Node("1", 23, 10);
    let node2 = new Node("2", 11, 11);
    let node3 = new Node("3", 20, 15);
    let node4 = new Node("4", 23, 23);
    let node5 = new Node("5", 12, 50);
    nodes.push(node1);
    nodes.push(node2);
    nodes.push(node3);
    nodes.push(node4);
    nodes.push(node5);
  }
  if (connections.length === 0) {
    let connection1 = new Connection(1, 2);
    let connection2 = new Connection(2, 3);
    let connection3 = new Connection(3, 4);
    let connection4 = new Connection(4, 5);
    let connection5 = new Connection(1, 2);
    let connection6 = new Connection(4, 1);
    let connection7 = new Connection(5, 3);
    let connection8 = new Connection(3, 1);
    let connection9 = new Connection(5, 3);
    let connection10 = new Connection(3, 5);
    connections.push(connection1);
    connections.push(connection2);
    connections.push(connection3);
    connections.push(connection4);
    connections.push(connection5);
    connections.push(connection6);
    connections.push(connection7);
    connections.push(connection8);
    connections.push(connection9);
    connections.push(connection10);
  }

  //  connect nodes
  let map = Map(nodes, connections);

  // set unset locations
  if (typeof departure == "undefined") {
    departure = map[0];
  }
  if (typeof destination == "undefined") {
    destination = map[4];
  }

  var search = new A_Star(departure, destination);

  let output = "";
  for (let i = 0; i < search.length; i++) {
    output += "->" + search[i].name;
  }
  return output;
  // return search;
}
