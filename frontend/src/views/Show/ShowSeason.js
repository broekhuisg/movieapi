import React, { useState, useEffect } from 'react'
import { useParams, Link } from 'react-router-dom'
import axios from '../../axios-api'

export default function ShowSeason(props) {
    const { id, seasonnumber } = useParams();
    const [show, setShow] = useState(null);

    useEffect(() => {
        if (props.location.state) {
            setShow(props.location.state.show)
            console.log(show)
        } else {
            axios.get('/tvshows/' + id)
                .then(result => {
                    setShow(result.data)
                    console.log(show)
                })
        }
    }, [])

    return (
        <div>
            {
                show?.seasons.map(season => {
                    if (season.seasonNumber == seasonnumber) {
                        return (
                            <React.Fragment>
                                <Link to={{ pathname: `/show/${show.id}` }}>Back to show</Link>
                                <h2>Season { season.seasonNumber }</h2>

                                { season.episodes.map(episode => {
                                    return (
                                        <React.Fragment>
                                            <h5>{ episode.title }</h5>
                                            <p>{ episode.duration } minutes</p>
                                        </React.Fragment>
                                    )
                                }) }
                            </React.Fragment>
                        )
                    }
                })
            }
        </div>
    )
}