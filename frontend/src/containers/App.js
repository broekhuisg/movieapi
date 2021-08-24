import React, { Fragment, useState } from 'react'
import { BrowserRouter as Router, Route, Redirect, useHistory } from 'react-router-dom'

import Topbar from "../components/layout/Topbar"
import Login from "../views/Login/Login"
import Home from "../views/Home/Home";

import ApiService from "../services/ApiService"
import TokenService from "../services/TokenService"
import UserEdit from "../views/User/Edit/UserEdit";

export default function App(props) {
    const history = useHistory();
    const [isLoggedIn, setIsLoggedIn] = useState(TokenService.hasToken());
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [loading, setLoading] = useState(false);
    const [status, setStatus] = useState({
        'success': false,
        'error': false
    });

    const login = (event) => {
        event.preventDefault();
        setLoading(true);

        ApiService.login({
            "email": email,
            "password": password
        })
            .then(() => {
                setStatus({
                    'success': true,
                    'error': false,
                })
                setLoading(false)
                setIsLoggedIn(true)
                history.push("/overview")
            })
            .catch(error => {
                setStatus({
                    'success': false,
                    'error': error,
                })
                setLoading(false)
            });
    }

    const logout = () => {
        ApiService.logout()
            .then(() => {
                setIsLoggedIn(false)
            })
            .catch(error => {
                console.log(error)
            });
    }

    return (
        <Fragment>
            <Router>
                <Topbar
                    isLoggedIn={isLoggedIn}
                    logout={() => logout()}
                />

                <Route path="/login" exact>
                    { TokenService.hasToken() ?
                        <Redirect to={"/"} />
                        :
                        <Login
                            isLoggedIn={isLoggedIn}
                            login={(e) => login(e)}
                            loginData={{
                                'email': email,
                                'setEmail': setEmail,
                                'password': password,
                                'setPassword': setPassword
                            }}
                            loading={loading}
                            status={status}
                        />
                    }
                </Route>

                <Route path="/user/edit" exact>
                    { !TokenService.hasToken() ?
                        <Redirect to={"/login"} />
                        :
                        <UserEdit />
                    }
                </Route>

                <Route path="/" exact>
                    <Home />
                </Route>
            </Router>
        </Fragment>
    )
}