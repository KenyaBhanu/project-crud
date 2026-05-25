<?php

function getStatus($status) {
    return $status ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-secondary">Inactive</span>';
}

function inputFailed($status) {
    return "<span class='text-danger'>$status</span>";
}