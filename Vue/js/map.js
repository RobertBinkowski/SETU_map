/**
 *  Title:          Map Creation
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Node } from "./node.js";
import { Connection } from "./connection.js";

export function Map(nodes, connections) {
  [nodes, connections] = prepareData(nodes, connections);

  //  Add Connections to the nodes one by one
  for (let i = 0; i < connections.length; i++) {
    nodes[connections[i].nodeOne - 1].addConnection(
      nodes[connections[i].nodeTwo - 1]
    );
    nodes[connections[i].nodeTwo - 1].addConnection(
      nodes[connections[i].nodeOne - 1]
    );
  }
  return nodes;
}

export function prepareData(locations, connections) {
  const nodes = [];
  const conn = [];

  // Create Nodes out of locations
  locations.forEach((location) => {
    nodes.push(
      new Node(
        location.id,
        location.name,
        location.geoLatitude,
        location.geoLongitude,
        location.mapAltitude,
        location.type
      )
    );
  });

  // Add Connections to the nodes one by one
  connections.forEach((connection) => {
    conn.push(
      new Connection(connection.locationOne.id, connection.locationTwo.id)
    );
  });

  return [nodes, conn];
}
