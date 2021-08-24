import React, { Fragment } from 'react'
import Button from "react-bootstrap/Button";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import { Link } from "react-router-dom";
import logo from "../assets/img/logo.png";

export default function TopbarNavMenu(props) {
    return (
        <Fragment>
            <Row>
                <Col xs={2}>
                    <Link to={"/"}><img src={logo} width={"100"}/></Link>
                </Col>
                <Col xs={10} className={'d-flex align-items-center flex-row-reverse'}>
                    <Link to={"/tv"}><Button variant={"primary"}>Tv</Button></Link>
                    <Link to={"/movies"}><Button variant={"primary me-3"}>Movies</Button></Link>
                </Col>
            </Row>
        </Fragment>
    )
}