<?php

function getStatus($status) {
    return $status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';
}