/**
 *  Title:          Connections
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Node } from "./node.js";
import { calculateDistance } from "./functions.js";
/**
 *  Connection between Nodes
 *
 * @param {Node} nodeOne - Connection Origin
 * @param {Node} nodeTwo - Connected To
 * @param {Double} distance - Distance
 * @returns
 */
export function Connection(nodeOne, nodeTwo, distance = 0) {
  this.oneNode = nodeOne;
  this.nodeTwo = nodeTwo;
  this.distance = distance;
  if (distance == 0) {
    distance = calculateDistance(nodeOne, nodeTwo);
  }
}
