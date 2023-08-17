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
  connections.forEach((connection) => {
    nodes
      .find((node) => node.id === connection.nodeOne)
      .addConnection(nodes.find((node) => node.id === connection.nodeTwo));
    nodes
      .find((node) => node.id === connection.nodeTwo)
      .addConnection(nodes.find((node) => node.id === connection.nodeOne));
  });

  return nodes;
}

export function prepareData(locations, connections) {
  const nodes = [];
  const conn = [];

  // Create Nodes out of locations
  locations.forEach((location) => {
    if (location.coordinates) {
      nodes.push(
        new Node(
          location.id,
          location.coordinates.latitude,
          location.coordinates.longitude,
          location.coordinates.altitude,
          location.type
        )
      );
    }
  });

  // Add Connections to the nodes one by one
  connections.forEach((connection) => {
    conn.push(
      new Connection(connection.locationOne.id, connection.locationTwo.id)
    );
  });

  return [nodes, conn];
}
