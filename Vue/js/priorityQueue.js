/**
 *  Title:          Priority Queue
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */
import { Node } from "./node.js";

export class PriorityQueue {
  constructor() {
    this.items = [];
  }

  enqueue(
    name,
    priority,
    x,
    y,
    z = 0,
    info = "",
    geo_longitude = null,
    geo_latitude = null
  ) {
    //Create Queue
    var queue = new Node(
      name,
      priority,
      name,
      priority,
      x,
      y,
      z,
      info,
      geo_longitude,
      geo_latitude
    );
    var contain = false;

    for (var i = 0; i < this.items.length; i++) {
      if (this.items[i].priority > queue.priority) {
        this.items.splice[(i, 0, queue)];
        contain = true;
        break;
      }
    }

    if (!contain) {
      this.items.push(queue);
    }
  }

  dequeue() {
    if (this.isEmpty()) {
      return "Empty";
    }
    return this.items.shift();
  }

  front() {
    if (this.isEmpty()) {
      return "Empty Queue";
    }
    return this.items[0];
  }

  rear() {
    if (this.isEmpty()) {
      return "No elements in Queue";
    }
    return this.items[this.items.length - 1];
  }

  isEmpty() {
    return this.items.length == 0;
  }

  printQueue() {
    var outcome = "";

    for (var i = 0; i < this.items.length; i++) {
      outcome += this.items[i].name + " ";
    }
    return outcome;
  }
}
