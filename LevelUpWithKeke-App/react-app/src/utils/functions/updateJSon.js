import React, { useState } from 'react';

export async function updateJsonFile(data,jsonPath) {
  try {
    const response = await fetch(jsonPath, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const result = await response.json();
    console.log(result.message);
  } catch (error) {
    console.error('Error updating JSON file:', error);
  }
}

