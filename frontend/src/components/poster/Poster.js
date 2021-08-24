import React, { useState, useEffect, Fragment } from 'react'
import Card from 'react-bootstrap/Card'

export default function Poster(props) {
    const [hasHeader, setHasHeader] = useState(false)
    console.log(props.media)

    useEffect(() => {
       setHasHeader(props.header)
    });

    return (
        <Fragment>
            <Card>
                { hasHeader ?
                    <Card.Header>
                        { new Date(props.media.inTheaterStart).toDateString() }
                    </Card.Header>
                    :
                    null
                }

                <Card.Img variant="top" src={ props.media.posterPath } />
            </Card>
        </Fragment>
    )
}