/**
 *  Title:          Node
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

export class Node {
  /**
   *
   *    Node Class
   *
   * @param {int} id - number of the node
   * @param {str} name - Name of the location
   * @param {double} x - X Coordinates
   * @param {double} y - Y Coordinates
   * @param {double} z - Z Coordinates
   * @param {str} type - Type of the location [room, bathroom] - Pulled from database
   *
   */
  constructor(id, name, x, y, z = 0, type = "Location") {
    this.id = id;
    this.name = name;

    //Location Information
    this.type = type;

    //Location Info
    this.coordinates = new coordinates(x, y, z);

    this.f = 0; //  Total Cost Function
    this.g = 0; //  Steps Taken from the start
    this.h = 0; //  Heuristic

    this.connections = []; // neighbors of the current point
    this.parent = undefined; // source of the current point
  }
  //Add Connection to the Node
  addConnection(node) {
    if (!this.connections.includes(node)) {
      this.connections.push(node);
    }
  }
}

export class coordinates {
  constructor(x, y, z) {
    this.longitude = x;
    this.latitude = y;
    this.altitude = z; // Also the Floor number 0 being Ground Floor
    this.location = "[" + x + "," + y + "," + z + "]";
  }
}
