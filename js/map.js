/**
 *  Title:          Map Creation
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Connection } from "./connection.js";
import { Node } from "./node.js";

export function Map() {
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

  //  Add Connections to the nodes one by one
  let i = 0;
  for (i = 0; i < connections.length; i++) {
    nodes[connections[i].nodeOne - 1].addConnection(
      nodes[connections[i].nodeTwo - 1]
    );
    nodes[connections[i].nodeTwo - 1].addConnection(
      nodes[connections[i].nodeOne - 1]
    );
  }

  return nodes;
}
