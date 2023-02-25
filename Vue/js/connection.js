/**
 *  Title:          Connections
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Node } from "./node.js";
/**
 *  Connection between Nodes
 *
 * @param {Node} nodeOne - Connection Origin
 * @param {Node} nodeTwo - Connected To
 * @returns
 */
export class Connection {
  constructor(nodeOne, nodeTwo) {
    this.nodeOne = nodeOne;
    this.nodeTwo = nodeTwo;
  }
}
