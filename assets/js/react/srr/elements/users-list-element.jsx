import React, { useEffect } from 'react';
import CartItem from "../components/cart-item.component";

// hooks
import usePaginatedFetch from "../hooks/paginate.hook";

// components
import Title from "../components/title.components";
import Loader from "../components/shop/loader.component";

/**
 *
 * @param userId
 * @returns {JSX.Element}
 * @constructor
 */
const UserList = ({userId}) => {
    const {loading, onLoadHandler, users, count, hasMore, nextPage} = usePaginatedFetch('/api/users')

    useEffect(() => {
        onLoadHandler().then(r => r);
    }, []);

    return (
        <div className="row">
            <div className="col-12 d-flex flex-column justify-content-center align-items-center ">
                <div>
                    <Title count={count}/>
                </div>

                <div className="d-flex flex-row justify-content-between flex-wrap align-items-center">
                    {users.map(user => {
                        return <CartItem key={user.id} user={user} userId={userId}/>
                    })}
                </div>
                {
                    (hasMore && !loading) && <div>
                        <button onClick={onLoadHandler} className="btn btn-success ">Chargement des users</button>
                    </div>
                }

                {(loading && (users.length > 0 || users.length === 0 )) && (
                    <Loader />
                )}

            </div>
        </div>

    );
};

export default UserList;
