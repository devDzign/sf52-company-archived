import React, {useState} from 'react';

const CounterElement = (props) => {

    const [count, setCount] = useState(props.count);

    const increment = () => {
        setCount(count + 1)
    }
    return (
        <h2 onClick={increment}>
           You have clicked me {count} times 😢
        </h2>
    );
};

export default CounterElement;
