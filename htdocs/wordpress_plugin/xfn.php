<?php

function offenraum_get_xnf()
{
    return array(
        "friendship" => array(
            "friend" => "Someone you are a friend to. A compatriot, buddy, home(boy|girl) that you know.",
            "acquaintance" => "Someone who you have exchanged greetings and not much (if any) more &mdash; maybe a short conversation or two.",
            "contact" => "Someone you know how to get in touch with. Often symmetric.",
        ),
        "physical" => array(
            "met" => "Someone who you have actually met in person.",
            "co-worker" => "Someone who you work with or works at the same organization as you.",
            "colleague" => "Someone in the same field of study or activity.",
        ),
        "family" => array(
            "child" => "A person's genetic offspring, or someone that a person has adopted and takes care of.",
            "parent" => "A person's progenitor, or someone who has adopted and takes care (or took care) of you.",
            "sibling" => "Someone a person shares a parent with.",
            "spouse" => "Someone you are married to.",
            "kin" => "A relative, someone you consider part of your extended family. Symmetric and typically transitive.",
        ),
        "romantic" => array(
            "muse" => "Someone who brings you inspiration.",
            "crush" => "Someone you have a crush on.",
            "date" => "Someone you are dating.",
            "sweetheart" => "Someone with whom you are intimate and at least somewhat committed, possibly exclusively.",
        ),
        "identity" => array(
            "me" => "A link to yourself at a different URL. Exclusive of all other XFN values. Required symmetric. There is an implicit 'me' relation from a subdirectory to all of its contents.",
        )
    );
}