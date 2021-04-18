import { Controller } from 'stimulus';
import ReactDOM from 'react-dom';
import React from 'react';
import HealthReact from "../js/react/srr/elements/health-react.element";


export default class extends Controller {
    static values = {
        name: String
    }

    connect() {
        ReactDOM.render(
            <HealthReact name={this.nameValue} />,
            this.element
        )
    }
}
