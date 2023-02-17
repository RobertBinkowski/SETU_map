/**
 *  Title:          Map Creation
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

export function Map(nodes, connections) {
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
