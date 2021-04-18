import { Controller } from 'stimulus';
import ReactDOM from 'react-dom';
import React from 'react';
import CounterElement from "../js/react/srr/elements/counter.element";

export default class extends Controller {
    static values = {
        count: Number
    }
    connect() {
        ReactDOM.render(
            <CounterElement count={this.countValue} />,
            this.element
        )
    }
}
