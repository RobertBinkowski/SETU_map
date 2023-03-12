import { Node } from "../node.js";
import { Connection } from "../connection.js";
import { search } from "../main.js";

function test() {
  let nodes = [];
  let connections = [];

  //  Set Unset Locations
  let node1 = new Node("Node 1", 10, 10);
  let node2 = new Node("Node 2", 11, 11);
  let node3 = new Node("Node 3", 12, 12, 0, "Elevator");
  let node4 = new Node("Node 4", 9, 9, 0, "Stairs");
  let node5 = new Node("Node 5", 8, 8);

  nodes.push(node1);
  nodes.push(node2);
  nodes.push(node3);
  nodes.push(node4);
  nodes.push(node5);

  let connection1 = new Connection(1, 2);
  let connection2 = new Connection(2, 3);
  let connection3 = new Connection(3, 5);
  let connection4 = new Connection(4, 5);

  let connection5 = new Connection(1, 4);
  let connection6 = new Connection(4, 5);

  connections.push(connection1);
  connections.push(connection2);
  connections.push(connection3);
  connections.push(connection4);
  connections.push(connection5);
  connections.push(connection6);

  let output = search(nodes, connections, node1, node5, true);
  console.log(output);
}

test();
