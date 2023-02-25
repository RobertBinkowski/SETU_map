/**
 *  Title:          Node
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Connection } from "./connection.js";
export class Node {
  connection = new Connection();
  /**
   *
   *    Node Class
   *
   * @param {str} name - Name of the location
   * @param {int} priority - priority
   * @param {double} x - X Coordinates
   * @param {double} y - Y Coordinates
   * @param {double} z - Z Coordinates
   * @param {str} info - Location Information
   * @param {str} acronym - Acronym of the location
   * @param {str} type - Type of the location [room, bathroom] - Pulled from database
   * @param {double} geo_longitude - Longitude Geo Location
   * @param {double} geo_latitude - Latitude Geo Location
   * @param {bool} blocked - Set weather it is accusable
   *
   */
  constructor(
    name,
    x,
    y,
    z = 0,
    info = "",
    acronym = "",
    type = "",
    geo_longitude = null,
    geo_latitude = null
  ) {
    this.name = name;

    //Location Information
    this.info = info;
    this.acronym = acronym;
    this.type = type;

    //Location Info
    this.x = x;
    this.y = y;
    this.z = z; // Also the Floor number 0 being Ground Floor
    this.location = "[" + x + "," + y + "," + z + "]";

    this.f = 0; //  Total Cost Function
    this.g = 0; //  Steps Taken from the start
    this.h = 0; //  Heuristic

    this.connections = []; // neighbors of the current point
    this.parent = undefined; // source of the current point

    this.geo_longitude = geo_longitude;
    this.geo_latitude = geo_latitude;
  }
  //Add Connection to the Node
  addConnection(node) {
    if (!this.connections.includes(node)) {
      this.connections.push(node);
    }
  }
}
