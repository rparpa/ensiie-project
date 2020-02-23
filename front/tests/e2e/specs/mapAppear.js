describe('Map and markers appears visible', () => {
    it('visit the / url', () => {
      cy.visit('/')
      cy.get('.mgl-map-wrapper').should('be.visible')
      cy.get('.mapboxgl-canvas').should('be.visible')
      cy.get('.mapboxgl-markerw').should('be.visible')
    })
  })
  