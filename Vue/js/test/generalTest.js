import { Node } from "../node.js";
import { Connection } from "../connection.js";
import { search } from "../main.js";

function test() {
  let nodes = [];
  let connections = [];

  //  Set Unset Locations
  let node1 = new Node(
    "Node 1",
    rand(500),
    rand(500),
    0,
    "",
    "",
    "",
    rand(500),
    rand(500)
  );
  let node2 = new Node(
    "Node 2",
    rand(500),
    rand(500),
    0,
    "",
    "",
    "",
    rand(500),
    rand(500)
  );
  let node3 = new Node(
    "Node 3",
    rand(500),
    rand(500),
    0,
    "",
    "",
    "",
    rand(500),
    rand(500)
  );
  let node4 = new Node(
    "Node 4",
    rand(500),
    rand(500),
    0,
    "",
    "",
    "",
    rand(500),
    rand(500)
  );
  let node5 = new Node(
    "Node 5",
    rand(500),
    rand(500),
    0,
    "",
    "",
    "",
    rand(500),
    rand(500)
  );

  nodes.push(node1);
  nodes.push(node2);
  nodes.push(node3);
  nodes.push(node4);
  nodes.push(node5);

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

  let output = search(nodes, connections, node1, node2);
  console.log(output);
}

function rand(val) {
  return Math.floor(Math.random() * val);
}

test();
